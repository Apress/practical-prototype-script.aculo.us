<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>Chapter 12</title>
    
    
    <script src="../js/prototype.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/scriptaculous.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
      document.observe('dom:loaded', function() {
        new Ajax.InPlaceEditor('team_name', '');        
      });
    </script>
    
    <style type="text/css" media="screen">
      body {
        font-family: "Lucida Grande", Tahoma, sans-serif;
        font-size: 67.5%;
      }
      
      h1#team_name, 
      form#team_name-inplaceeditor .editor_field {
        font-size: 19px;
        font-weight: bold;
      }
      
    </style>
  </head>
  <body>
    
    
    <h1 id="team_name">The Fighting Federalists</h1>


  </body>
</html>