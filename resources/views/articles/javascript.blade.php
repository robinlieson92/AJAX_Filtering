<!-- script pagination -->
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
      dataType : "json",
      success : function(data) {
        $('.list').html(data['view']);
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

<!-- script searching -->
<script>
  $('#search').on('click', function(){
    $.ajax({
      url : '/articles',
      type : "GET",
      dataType : "json",
      data : {
        'keywords' : $('#keywords').val()
      },
      success : function(data) {
        $('.list').html(data['view']);
      },
      error : function(xhr, status) {
        console.log(xhr.error + " ERROR STATUS : " + status);
      },
      complete : function() {
        alreadyloading = false;
      }
    });
  });
</script>

<!-- script sorting -->
<script>
$(document).ready(function() {
  $(document).on('click', '#id', function(e) {
    sort_articles();
    e.preventDefault();
  });
});
function sort_articles() {
  $('#id').on('click', function() {
    $.ajax({
      url : '/articles',
      typs : "GET",
      dataType : 'json',
      data : {
        "direction" : $('#direction').val()
      },
      success : function(data) {
        $('.list').html(data['view']);
        $('#direction').val(data['direction']);
        if(data['direction'] == 'asc') {
          $('.ic-direction').attr({class: "gylphicon glyphicon-arrow-up"});
        } else {
          $('.ic-direction').attr({class: "gylphicon glyphicon-arrow-down"});
        }
      },
      error : function(xhr, status, error) {
        console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
      },
      complete : function() {
        alreadyloading = false;
      }
    });
  });
}
</script>