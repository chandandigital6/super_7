@extends('front.layouts.app')

@section('content')
<div style="background:#21739c;box-shadow:inset -5px -5px 22px #0d2e3e , inset 5px 5px 22px #35b8fa"
class="flex items-center justify-center px-4 py-2 pt-6 mx-4 my-2 rounded-xl">
<h2 class="mb-4 text-sm font-semibold leading-10 text-center text-white md:text-3xl">
    {{$category->title}} - {{ now()->year }}
</h2>
</div>

    <section class="newtable">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 nopadding">
                    <div class="table-responsive" style="
                        overflow-x:scroll;">
                        <table class="w-full table-auto ">
                            <tr  class="text-white bg-amber-900">
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                            class="px-3 py-3 ">Date</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">JANUARY</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">FEBRUARY</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">MARCH</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">APRIL</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">MAY</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">JUNE</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">JULY</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">AUGUST</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">SEPTEMBER</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">OCTOBER</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">NOVEMBER</th>
                                <th style="background:#044e41;box-shadow:inset -5px -5px 22px #021f1a , inset 5px 5px 22px #067d68"
                                class="px-3 py-3 ">DECEMBER</th>
                            </tr>
                            @for( $i=1; $i<=31; $i++)
                                <tr>
                                    <td style="background:#640080;box-shadow:inset -5px -5px 5px #280033 , inset 5px 5px 5px #a000cd"
                                    class="w-full py-1 text-white text-center border border-[#640080]">{{$i}}</td>
                                    @foreach($results as $result)
                                        <td style="background:#640080;box-shadow:inset -5px -5px 5px #280033 , inset 5px 5px 5px #a000cd"
                                        class="w-full py-1 text-white text-center border border-[#640080]">@if(isset($result[$i]) && is_numeric($result[$i]) && $result[$i] <= 9 )
    {{ str_pad($result[$i], 2, '0', STR_PAD_LEFT) }}
@else
  {{isset($result[$i]) ? $result[$i] :"--"}}
@endif
</td>
                                    @endforeach
                                </tr>
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        {!! $faq !!}
        </div>
@endsection

