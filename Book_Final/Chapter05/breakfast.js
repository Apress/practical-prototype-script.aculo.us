
// Toggle the visibility of our form
function toggleEntryForm(event) {
  $('entry').toggle();
  event.preventDefault();
}

// Redirect the submission to use Ajax
function submitEntryForm(event) {
  event.preventDefault();
  var valid = true;
  $('food_type', 'taste').each(function(box) {
    if (box.value.length === 0) {
      box.addClassName('invalid');
      valid = false;
    } else box.removeClassName('invalid');
  });
  if (!valid) {
    alert('Both fields are required.');
    return;
  }
  var updater = new Ajax.Updater( { success: 'breakfast_history', failure: 'error_log' },
    'breakfast.php',
    { parameters: { food_type: $('food_type').value, taste: $('taste').value } });
}

function addObservers() {
  $('entry').observe('submit', submitEntryForm);
  $('toggler').observe('click', toggleEntryForm);  
  $('food_type', 'taste').invoke('observe', 'blur', onTextBoxBlur);
}


function addObservers() {
  $('toggler').observe('click', toggleEntryForm);
  $('entry').observe('submit', submitEntryForm);
  $('entry').getInputs('text').invoke('observe', 'blur', onTextBoxBlur);
}

function onTextBoxBlur(event) {
  var textBox = event.target;
  if (textBox.value.length === 0) textBox.addClassName('invalid');
  else textBox.removeClassName('invalid');
}

Event.observe(window, 'load', addObservers);
Event.observe(window, 'load', function() { $('entry').hide(); });

