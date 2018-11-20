</div><br><br>
<div class="col-md-12 text-center">&copy; Copyright 2018-2019 Bookstore</div>

<script>
  function get_child_options(selected){
    if(typeof selected === 'undefined'){
      var selected = '';
    }
    var parentID = jQuery('#parent').val();
    jQuery.ajax({
      url: '/Proiect1/admin/parsers/child_categories.php',
      type: 'POST',
      data: {parentID : parentID, selected: selected},
      success: function(data){
        jQuery('#child').html(data);
      },
      error: function(){alert("Something went wrong with the child options")},

    });

  }
  jQuery('select[name="parent"]').change(function(){
    get_child_options();
  });
</script>
</body>
</html>
