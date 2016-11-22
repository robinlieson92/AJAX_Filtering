@extends("layouts.application")
@section("content")
  @include("articles._index")
  
  <script>
    $(document).ready(function() {
      $(document).on('click', '.pagination a', function(e) {
        get_page($(this).attr('href').split('page=')[1]);
        e.preventDefault();
      });
    });

    function get_page(page) {
      $.ajax({
        url : '/articles?page='+page,
        type : "GET",
        dataType : 'json',
        success : function(data) {
          $('.panel-body').html(data);
        },
        error : function(xhr, status, error) {
          console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
        },
        complete : function() {
          alreadyloading = false;
        }
      });
    }
  </script>

@stop