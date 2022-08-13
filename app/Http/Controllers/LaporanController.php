<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export() {
        return view('batik.export');
    }


    public function exportPost(Request $request) {
        // Validasi
        $this->validate($request, [
            'categories_id' => 'required',
            'type' => 'required|in:pdf,xls'
        ], [
            'categories_id.required' => 'Anda belum memilih nama batik. Pilih minimal 1 batik.'
        ]);

        $batiks = Batik::whereIn('id', $request->get('categories_id'))->get();

        $handler = 'export' . ucfirst($request->get('type'));

        return $this->$handler($books);
    }

    private function exportXls($books)
    {
        Excel::create('Data Batik Ciprat Langitan', function($excel) use ($books) {
            // Set Property
            $excel->setTitle('Data Batik Ciprat Langitan')->setCreator('Dika Ayu Wijayanti');

            $excel->sheet('Data Batik', function($sheet) use ($batiks) {
                $row = 1;
                $sheet->row($row, [
                    'Nama Batik',
                    'Deskripsi',
                    'Price',
                    'Kategori',
                    'Stok'
                ]);
                foreach ($batiks as $batik) {
                    $sheet->row(++$row, [
                        $batik->name,
                        $batik->descriptions,
                        $batik->price,
                        $batik->categories_id,
                        $batik->stok,
                        $batik->author->name
                    ]);
                }
            });
        })->export('xlsx');
    }

    public function exportPdf($batiks) {
        $pdf = PDF::loadview('pdf.batik', compact('batik'));

        return $pdf->download('batik.pdf');
    }

    public function generateExcelTemplate() {
        Excel::create('Template Import Buku', function($excel) {
            // Set the properties
            $excel->setTitle('Template Import Buku')
                ->setCreator('E-Perpus')
                ->setCompany('E-Perpus')
                ->setDescription('Template import buku untuk E-Perpus');

            $excel->sheet('Data Buku', function($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'judul',
                    'penulis',
                    'jumlah'
                ]);
            });
        })->export('xlsx');
    }

    public function importExcel(Request $request) {
        // Validasi untuk memastikan file yang diupload adalah excel
        $this->validate($request, ['excel' => 'required|mimes:xls,xlsx']);

        // Ambil file yang baru diupload
        $excel = $request->file('excel');

        // Baca sheet pertama
        $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader) {
            // Options, jika ada
        })->get();

        // Rule untuk validasi setiap row pada file excel
        $rowRules = [
            'judul'     => 'required',
            'penulis'   => 'required',
            'jumlah'    => 'required'
        ];

        // Catat semua id buku baru
        // ID ini kita butuhkan untuk menghitung total buku yang berhasil diimport
        $books_id = [];

        // Looping setiap baris, mulai dari baris ke 2 (karena baris ke 1 adalah nama kolom)
        foreach ($excels as $row) {
            // Membuat validasi untuk row di excel
            // Disini kita ubah baris yang sedang diproses menjadi array
            $validator = Validator::make($row->toArray(), $rowRules);

            // Skip baris ini jika tidak valid, langsung ke baris selanjutnya
            if ($validator->fails()) continue;

            // Syntax dibawah dieksekusi jika baris excel ini valid

            // Cek apakah Penulis sudah terdaftar di database
            $author = Author::where('name', $row['penulis'])->first();

            // Buat penulis jika belum ada
            if (!$author) {
                $author = Author::create(['name' => $row['penulis']]);
            }

            // Buat buku baru
            $book = Book::create([
                'title'     => $row['judul'],
                'author_id' => $author->id,
                'amount'    => $row['jumlah']
            ]);

            // Catat id dari buku yang baru dibuat
            array_push($books_id, $book->id);
        }

        // Ambil semua buku yang baru dibuat
        $books = Book::whereIn('id', $books_id)->get();

        // Redirect ke form jika tidak ada buku yang berhasil diimport
        if ($books->count() == 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();
        }

        // Set feedback
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengimport " . $books->count() . " buku."
        ]);

        // Tampilkan index buku
        return view('books.import-review')->with(compact('books'));
    }

}

