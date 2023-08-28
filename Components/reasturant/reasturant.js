$(document).ready(function() {
    $('.menu li a').click(function(e) {
      e.preventDefault();
      $('.menu li a').removeClass('active');
      $(this).addClass('active');
      var page = $(this).data('page');
      console.log(page);
     
      console.log(page);
      loadContent(page);
    });
    function loadContent(page) {
      $.ajax({
        url: page + '.php',
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#page-content').html(response);
        },
        error: function(xhr) {
          $('#page-content').html('Error loading page.');
        }
      });
    }
    loadContent('dashboard');
    
    $('.menu2 li a').click(function(e) {
      e.preventDefault();
      $('.menu2 li a').removeClass('active2');
      $(this).addClass('active2');
      var page = $(this).data('page');
      console.log(page);
     
      console.log(page);
      loadContent(page);
    });
    function loadContent(page) {
      $.ajax({
        url: page + '.php',
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#page-content').html(response);
        },
        error: function(xhr) {
          $('#page-content').html('Error loading page.');
        }
      });
    }
    loadContent('reasturant_Table');
    
  });