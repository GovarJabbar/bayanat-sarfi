<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    <title>قاعدة بيانات الميزان الصرفي</title>
    <style>
        @font-face {
        font-family: 'Droid Arabic Naskh';
            src:  url('fonts/Droid-Arabic-Naskh.ttf.woff') format('woff'),
            url('fonts/Droid-Arabic-Naskh.ttf.svg#Droid-Arabic-Naskh') format('svg'),
            url('fonts/Droid-Arabic-Naskh.ttf.eot'),
            url('fonts/Droid-Arabic-Naskh.eot?#iefix') format('embedded-opentype'); 
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <script src="{{ asset('js/semantic.min.js') }}"></script>
</head>

<body>
    <div id="sarf" class="">
        <div class="row">
            <div class="col-4">
                السورة:
                <select id="surah" @change="getAyas($event.target)" class="form-control">
                    @foreach (DB::table('fahras')->select('index','surrahname','numberofayah')->orderBy('index')->get() as $i=>$surah)
                        <option {{ !$i ? 'selected' : '' }} value="{{ $surah->index }}" data-ayas="{{ $surah->numberofayah }}">{{ $surah->surrahname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                الآية:
                <select id="ayah" @change="getWords()" class="form-control">
                    <option v-for="(ayah,i) in numberofayah">@{{ ++i }}</option>
                </select>
            </div>
            <div class="col-4">
                <div class="ui vertical basic buttons" style=" width: 250px; " @change="selected($event.target)">
                    <select id="words" class="form-control" size="6" style=" max-height: 154px; min-height: 154px; ">
                        <option v-for="(item,i) in word_list" :selected="!i" :value="item.id">@{{ item.nas }}</option>
                    </select>
                </div>
            </div>
            <div class="col-8" style=" position: absolute; top: 80px; ">
                <textarea v-if="tashkil_check" class="form-control" readonly v-model="ayah"></textarea>
                <textarea v-if="!tashkil_check" class="form-control" readonly v-model="ayah_no"></textarea>
            </div>
            <div class="col" style="margin-top: -35px;    max-width: 10px !important;">
                <div class="ui checkbox">
                    <input type="checkbox" v-model="tashkil_check" tabindex="0">
                    <label></label>
                </div>
            </div>
        </div>
        <hr style="width:100%;">
        <div class="row">
            <div class="col-5">
                <div class="ui top attached tabular menu">
                    <div class="active item">النصّ مجردا <small class="mr-2"> (من  السوابق واللواحق)</small></div>
                </div>
                <div class="ui bottom attached active tab segment">
                    <p>
                        @{{ selected_data.nas2 }}
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="ui top attached tabular menu">
                    <div class="active item">الوزن</div>
                </div>
                <div class="ui bottom attached active tab segment">
                    <p>
                         @{{ selected_data.wazn }}
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="ui top attached tabular menu">
                    <div class="active item">جذر و باب</div>
                </div>
                <div class="ui bottom attached active tab segment">
                    <p>
                         @{{ selected_data.jazr }} <small>(@{{ selected_data.bab }})</small>
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="ui top attached tabular menu">
                    <div class="active item">نوع</div>
                </div>
                <div class="ui bottom attached active tab segment">
                    <p>
                         @{{ selected_data.type }}
                    </p>
                </div>
            </div>
        </div>
        <button class="btn btn-info" style="color: #fff; float: left; margin-top: 10px;" data-toggle="modal" data-target="#about">عننا</button>

        <!-- Modal -->
        <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="aboutLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutLabel">عننا</h5>
            </div>
            <div class="modal-body" style="min-height: 150px;line-height:2.5; ">
                قاعدة بيانات الميزان الصرفي <br>
                إعداد: گۆڤار جبار ممند<br>
                شکلا لـ: (حوسبة) محمد يوسف ملكاوي<br>
                <img style=" height: 150px; position: absolute; left: 0; top: 0; " src="logo.png"/>
            </div>
            <div class="modal-footer">
                <center>
                    جامعة ڕاپەڕین
                </center>
            </div>

        </div>
        </div>
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}?v={{ rand(999,99999) }}"></script>
</body>

</html>