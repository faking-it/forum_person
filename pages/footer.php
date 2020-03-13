<footer class="footer">
 <a class="nav-link active" href="#">&copy :Team Person</a>
</footer>

    <script src="../js/input_limit.js"></script><!-- nbre de lettre inside formulaire new-topics -->
    <!-- imoji -->
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> 

    <script src="../lib/js/config.js"></script>
    <script src="../lib/js/util.js"></script>
    <script src="../lib/js/jquery.emojiarea.js"></script>
    <script src="../lib/js/emoji-picker.js"></script>
    <script>
    $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: '../lib/img/',
        popupButtonClasses: 'fa fa-smile-o'
      });
      // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
      // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
      // It can be called as many times as necessary; previously converted input fields will not be converted again
      window.emojiPicker.discover();
    });
  </script>
   <!-- End imoji -->
</body>
</html>