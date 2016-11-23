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
        $('.list').html(data);
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
        $('.list').html(data);
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