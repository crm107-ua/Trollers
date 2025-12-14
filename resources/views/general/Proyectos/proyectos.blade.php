<!DOCTYPE html>
<html lang="en">
@include('general.Head.head')
  <body>


  <div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  @include('general.Header.header')

  <main class="main-content">
    <div class="container-fluid photos">
      <div class="row justify-content-center">

        <div class="col-md-8 pt-4">

          <div class="row mb-5" data-aos="fade-up">
            <div class="col-12">
              <h2 class="text-white mb-4 text-center">{{ trans('messages.opr') }}</h2>
            </div>
          </div>
          <div class="row">
              @foreach($proyectos as $proyecto)
                <div class="col-md-12" data-aos="fade-up">
                  <div class="d-flex blog-entry align-items-start">
                    <div>
                      @if($proyecto->id==1)
                        <h2 class="mt-0 mb-3"><a style="color: white">{{$proyecto->titulo}}</a> ⭐</h2>
                      @else
                        <h2 class="mt-0 mb-3"><a style="color: white">{{$proyecto->titulo}}</a></h2>
                      @endif
                      <div class="meta mb-3">{{ trans('messages.place') }}: {{$proyecto->lugar}}</div>
                      <p><p>{{$proyecto->descripcion}}</p></p>
                      @if($proyecto->nivel==10)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #A10000"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==11)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #603388"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==9)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #E74C3C"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==8)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #EC7063"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==7)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #E67E22"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==6)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #EB984E"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==5)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #EBD14E"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==4)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #BCE846"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==3)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #ABEBC6"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @elseif($proyecto->nivel==2)
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #58D68D"> -{{$proyecto->nivel}}- </a> {{ trans('messages.dg') }}</p></p>
                      @else
                      <p><p>{{ trans('messages.lvl') }} <a style="color: #77FF33"> -{{$proyecto->nivel}}- </a>{{ trans('messages.dg') }} </p></p>
                      @endif
                    </div>
                  </div>
                </div>
                @if(Auth::check() && Auth::user()->rol==1)
                  <form action="{{ route('eliminar-proyecto') }}" method="post" style="float:left;">
                      @csrf 
                      <div hidden>
                          <input name="id" value="{{$proyecto->id}}">
                      </div>
                      <input type="submit" style="margin-bottom:15px; margin-left:8px;" onclick="return confirm('¿Seguro que quieres eliminarlo?')" class="btn btn-danger" value="Eliminar" name="submit">
                  </form>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>

      @include('general.Footer.footer')
      
    </main>

  @include('general.Links.scripts')

  </body>
</html>
