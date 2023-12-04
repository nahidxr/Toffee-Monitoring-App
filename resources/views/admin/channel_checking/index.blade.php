<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    header {
      background-color: #343a40;
      color: #fff;
      padding: 15px;
      text-align: center;
    }

    .mosaic-container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      padding: 20px;
      background: url('dotted-pattern.png'); /* Replace 'dotted-pattern.png' with the path to your image */
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .channel-item {
      position: relative;
      background-color: #fff;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .channel-item:hover {
      transform: scale(1.05);
    }

    .channel-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 10px;
      object-fit: cover;
    }

    .channel-name {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .channel-options {
      font-size: 14px;
      color: #495057;
    }

    .channel-status {
      margin-top: 10px;
      font-weight: bold;
      color: #6c757d;
    }

    .channel-light {
      height: 20px;
      width: 20px;
      display: inline-block;
      margin-right: 5px;
      animation: blink 1s infinite alternate; /* Blinking animation */
      border-radius: 50%; /* Make the light circular */
    }

    .light-green {
      background-color: #28a745; /* Green color */
    }

    .light-red {
      background-color: #dc3545; /* Red color */
    }

    .channel-button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .channel-button:hover {
      background-color: #0056b3;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    @keyframes blink {
      from {
        opacity: 1;
      }
      to {
        opacity: 0.2;
      }
    }
  </style>
  <title>Toffee Monitoring App</title>
</head>
<body>

  <header>
    <h1>Toffee Channel Check</h1>
    <a href="{{ url('/') }}" class="nav-link">
          <i class="fas fa-folder"></i>
          <p>
            Dashboard
          </p>
        </a>
  </header>
  <div class="mosaic-container">

    @foreach($cprofile_list as $channel)
    <div class="channel-item" id="channel{{ $channel->id }}">
        <a href="#" class="playButton" data-channel-link="{{ $channel->Profile_link }}">
            <img src="{{ url('upload/images/'.$channel->image) }}" class="brand-image elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 40px; width: 60px; margin-top: 10px;">
        </a>      
        <div class="channel-name">{{ $channel->cname->name }}</div>
        {{-- <div class="channel-status">
            <span class="channel-light light-green"></span>
            <span class="status">Status: Active</span>
            <span class="status">Status: {{ $channel->status }}</span>
        </div>     --}}

        
        <div class="channel-status">
          <span class="channel-light light-green"></span>
          <span class="status">Status: Active</span>
      </div>
  
    </div>
@endforeach
 
    <!-- Modal for video playback -->
    <div id="videoModal" class="modal">
        <div class="modal-content" style="width: 400px;height: 400px;">
          <span class="close">&times;</span>
          <div id="rmp" style="display: block;"></div>
        </div>
      </div>
{{-- script start --}}

<!-- Include Radiant Media Player JavaScript library -->
<script src="https://cdn.radiantmediatechs.com/rmp/9.12.0/js/rmp-hlsjs.min.js"></script>
<script>
// Update channel light color based on status
var channels = document.querySelectorAll('.channel-item');

channels.forEach(function(channel) {
    var status = channel.querySelector('.status').textContent;

    if (status.includes('Inactive')) {
        var light = channel.querySelector('.channel-light');
        light.classList.remove('light-green');
        light.classList.add('light-red');
    }
});

</script>
<!-- Add a div container with a unique id - video and UI elements will be appended to this container -->
<script>
// Open modal and play video when play button is clicked
var playButtons = document.querySelectorAll('.playButton');
    playButtons.forEach(function(playButton) {
      playButton.addEventListener('click', function() {
        document.getElementById('videoModal').style.display = 'block';
        var channelLink = this.dataset.channelLink; // Fetching data-channel-link attribute from the clicked element
        fetchChannelLink(channelLink);
        playVideo(channelLink); // Function to start video playback
       
      });
    });

    // Fetch and log the response from the channel link
function fetchChannelLink(channelLink) {

  fetch(channelLink)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {

      const baseURL = 'https://mcdn-test.toffeelive.com/cdn/live/slang/';
      const generatedURLs = generateFullURLs(data, baseURL);
      

      console.log(generatedURLs);
      // You can process or handle the stream information further here as needed
    })
    .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });
}

function generateFullURLs(responseText, baseURL) {
  const lines = responseText.split('\n');
  const fullURLs = [];

  for (let i = 0; i < lines.length; i++) {
    if (lines[i].startsWith('#EXT-X-STREAM-INF:')) {
      const regexResult = /\/([^/]+\.m3u8)\?bitrate=(\d+)&channel=([^&]+)/.exec(lines[i + 1]);
      if (regexResult && regexResult.length === 4) {
        const fileName = regexResult[1];
        const bitrate = regexResult[2];
        const channel = regexResult[3];

        fullURLs.push(`${baseURL}${channel}/${fileName}?bitrate=${bitrate}&channel=${channel}&gp_id=`);
      }
    }
  }

  return fullURLs;

  
}

    // Close modal when close button is clicked
    document.querySelector('.close').addEventListener('click', function() {
      document.getElementById('videoModal').style.display = 'none';
      stopVideo(); // Function to stop video playback
    });

    // Function to start video playback
    function playVideo(channelLink) {
      // console.log(channelLink);

      const src = {
        // console.log(channelLink);
       
       // hls: 'https://bldcmstag-cdn.toffeelive.com/cdn/live/boishakhi/playlist.m3u8'
       hls: channelLink
        
      };
      const settings = {
        licenseKey: 'ZW5ieGlkcGtna0AxNjQwODAz',
        src: src,
        width: 400,
        height: 360,
  // Let us select a skin
     skin: 's1',
  // Let us add a poster frame to our player
    contentMetadata: {
      poster: [
        'feature_image_880420001595835330.png'
      ]
    },
    };
      const elementID = 'rmp';
      const rmp = new RadiantMP(elementID);
      rmp.init(settings);
      rmp.load(src);
    }

    // Function to stop video playback
    function stopVideo() {
      const rmp = document.getElementById('rmp');
      if (rmp) {
        rmp.innerHTML = ''; // Clear the player content
      }
    }

</script>

</body>
</html>
