@extends('user.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <strong class="text-black">Detail Order</strong>
            </div>
        </div>
    </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <h2 class="display-5">Penilaian Produk</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table>
                                        <tr>
                                            <th>No Invoice</th>
                                            <td>:</td>
                                            <td>
                                                <a
                                                    href="{{ route('user.order.detail', ['id' => $order->id]) }}">{{ $order->invoice }}</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Nama produk</th>
                                            <td>:</td>
                                            <td>
                                                <a
                                                    href="{{ route('user.produk.detail', ['id' => $detail->id]) }}">{{ $detail->name }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td>:</td>
                                            <td>{!! $detail->description !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Gambar</th>
                                            <td>:</td>
                                            <td>
                                                <img src="{{ url('storage/'.$detail->image) }}" width="50%"
                                                    style="height:50%">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Harga</th>
                                            <td>:</td>
                                            @php
                                                $detail->price = (int) str_replace('.', '', $detail->price);
                                            @endphp
                                            <td>Rp. {{ number_format($detail->price, 2, ',', '.') }}</td>
                                        </tr>
                                    </table>
                                    <form action="/order/penilaian" method="POST">
                                        @csrf

                                        <div class="row mt-3">
                                            <hr>
                                            <input type="hidden" name="orderId" value="{{ $order->id }}">
                                            <input type="hidden" name="productId" value="{{ $detail->id }}">
                                            <label for="staticEmail" class="col-sm-4 col-form-label mt-3"><b>Rating
                                                    penilaian</b></label>
                                            <div class="col-sm-8 mt-3">
                                                <div class="rating"> <input type="radio" name="rating" value="5"
                                                        id="5" required><label for="5">☆</label> <input
                                                        type="radio" name="rating" value="4" id="4"><label
                                                        for="4">☆</label> <input type="radio" name="rating"
                                                        value="3" id="3"><label for="3">☆</label> <input
                                                        type="radio" name="rating" value="2" id="2"><label
                                                        for="2">☆</label> <input type="radio" name="rating"
                                                        value="1" id="1"><label for="1">☆</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="inputReview"
                                                class="col-sm-4 col-form-label"><b>Penilaian</b></label>
                                            <div class="col-sm-8 mt-3">
                                                <textarea required class="form-control" name="pesan" type="text" placeholder="Penilaian produk..."
                                                    style="height: 10rem" data-sb-validations="required"></textarea>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning btn-block rating-submit"
                                            type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 30px;
            font-weight: 300;
            color: #FFD600;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>
@endsection
@section('js')
    <script>
        // Starrr plugin (https://github.com/dobtco/starrr)
        var __slice = [].slice;

        (function($, window) {
            var Starrr;

            Starrr = (function() {
                Starrr.prototype.defaults = {
                    rating: void 0,
                    numStars: 5,
                    change: function(e, value) {}
                };

                function Starrr($el, options) {
                    var i, _, _ref,
                        _this = this;

                    this.options = $.extend({}, this.defaults, options);
                    this.$el = $el;
                    _ref = this.defaults;
                    for (i in _ref) {
                        _ = _ref[i];
                        if (this.$el.data(i) != null) {
                            this.options[i] = this.$el.data(i);
                        }
                    }
                    this.createStars();
                    this.syncRating();
                    this.$el.on('mouseover.starrr', 'span', function(e) {
                        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
                    });
                    this.$el.on('mouseout.starrr', function() {
                        return _this.syncRating();
                    });
                    this.$el.on('click.starrr', 'span', function(e) {
                        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
                    });
                    this.$el.on('starrr:change', this.options.change);
                }

                Starrr.prototype.createStars = function() {
                    var _i, _ref, _results;

                    _results = [];
                    for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <=
                        _ref ? _i++ : _i--) {
                        _results.push(this.$el.append(
                            "<span class='glyphicon .glyphicon-star-empty'></span>"));
                    }
                    return _results;
                };

                Starrr.prototype.setRating = function(rating) {
                    if (this.options.rating === rating) {
                        rating = void 0;
                    }
                    this.options.rating = rating;
                    this.syncRating();
                    return this.$el.trigger('starrr:change', rating);
                };

                Starrr.prototype.syncRating = function(rating) {
                    var i, _i, _j, _ref;

                    rating || (rating = this.options.rating);
                    if (rating) {
                        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <=
                            _ref ? ++_i : --_i) {
                            this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass(
                                'glyphicon-star');
                        }
                    }
                    if (rating && rating < 5) {
                        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --
                            _j) {
                            this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass(
                                'glyphicon-star-empty');
                        }
                    }
                    if (!rating) {
                        return this.$el.find('span').removeClass('glyphicon-star').addClass(
                            'glyphicon-star-empty');
                    }
                };

                return Starrr;

            })();
            return $.fn.extend({
                starrr: function() {
                    var args, option;

                    option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                    return this.each(function() {
                        var data;

                        data = $(this).data('star-rating');
                        if (!data) {
                            $(this).data('star-rating', (data = new Starrr($(this), option)));
                        }
                        if (typeof option === 'string') {
                            return data[option].apply(data, args);
                        }
                    });
                }
            });
        })(window.jQuery, window);

        $(function() {
            return $(".starrr").starrr();
        });

        $(document).ready(function() {

            $('#hearts').on('starrr:change', function(e, value) {
                $('#count').html(value);
            });

            $('#hearts-existing').on('starrr:change', function(e, value) {
                $('#count-existing').html(value);
            });
        });
    </script>
@endsection
