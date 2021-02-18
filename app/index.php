<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>TextToSpeech</title>
      <!-- Bootstrap core CSS -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
         integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" rel="stylesheet">
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
               <h1 class="mt-5">TextToSpeech</h1>
               <ul class="list-unstyled"></ul>
               <!-- <input id="text" placeholder="Type here..." size=45 type="text" name="text" class="form-control"></br> -->
			   <textarea id="text" placeholder="Type here..." rows="10" name="text" class="form-control"></textarea></br>
               <button id="speak-button" name="speak" class="btn btn-primary">Speak (ctrl+enter)</button><br/><br/>
               <audio id="audio" controls autoplay hidden></audio>
               <p id="message"></p>
            </div>
         </div>
      </div>
      <script>
         function q(selector) {return document.querySelector(selector)}
         q('#text').focus()
         function do_tts(e) {
             text = q('#text').value
             if (text) {
                 q('#message').textContent = 'Synthesizing...'
                 q('#speak-button').disabled = true
                 q('#audio').hidden = true
                 synthesize(text)
             }
             e.preventDefault()
             return false
         }
         q('#speak-button').addEventListener('click', do_tts)
         q('#text').addEventListener('keyup', function(e) {
           if (e.ctrlKey && e.keyCode == 13) { // ctrl+enter
             do_tts(e)
           }
         })
         function synthesize(text) {
             fetch('/handler.php?text=' + encodeURIComponent(text), {cache: 'no-cache'})
                 .then(function(res) {
                     if (!res.ok) throw Error(res.statusText)
                         return res.blob()
                     }).then(function(blob) {
                         q('#message').textContent = ''
                         q('#speak-button').disabled = false
                         q('#audio').src = URL.createObjectURL(blob)
                         q('#audio').hidden = false
                     }).catch(function(err) {
                         q('#message').textContent = 'Error: ' + err.message
                         q('#speak-button').disabled = false
                     })
         }
      </script>
   </body>
</html>
