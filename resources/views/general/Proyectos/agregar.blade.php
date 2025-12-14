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
        <div class="col-md-6 pt-4">
          <h2 class="text-white mb-4" data-aos="fade-up">{{ trans('messages.addpr') }}</h2>
          <form action="{{ route('proyecto') }}" method="post">
            @csrf 
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.t') }}:</label>
                    <input name="titulo" style="background-color: white; color:black; border-radius: 10px; padding: 5px;" required> 
                </div>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.place') }}:</label>
                    <input name="lugar" style="backgroun9d-color: white; color:black; border-radius: 10px; padding: 5px;" required> 
                </div>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.d') }}:</label>
                    <textarea class="form-control" name="descripcion" style="background-color: white; color:black; border-radius: 10px; padding: 15px;" rows="5" maxlength="400" required></textarea>
                </div>
                <div class="form-group">
                    <label class="text-white mb-4" style="margin-right:20px;">{{ trans('messages.lvl') }}:</label>
                    <select name="nivel" class="form-control mb-4"> 
                        <option value="1">1</option> 
                        <option value="2">2</option> 
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected="selected">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" style="border-radius: 10px; background-color: #FFC686;" value="{{ trans('messages.addpr') }}" name="submit">
                </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  @include('general.Links.scripts')
  </body>
</html>
