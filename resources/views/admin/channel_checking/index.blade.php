<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      
    }
    .text-danger-glow {
    color: #ff4141;
     text-shadow: 0 0 20px #f00, 0 0 30px #f00, 0 0 40px #f00, 0 0 50px #f00, 0 0 60px #f00, 0 0 70px #f00, 0 0 80px #f00;
   }

    .blink {
      animation: blinker 1s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
    }
    @keyframes blinker {  
    from { opacity: 1; }
    to { opacity: 0; }
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
    /* Rounded modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 10%;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      border-radius: 25px; /* Adjust the border-radius to create rounded corners */
      padding: 20px;
      border: 1px solid #e6337a;
      width: 80%;
      max-width: 600px;
      margin: 15% auto;
    }

    .close {
      color: red; /* Change the color to red */
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: darkred; /* Change hover/focus color */
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
    /* CSS modifications for channel-item checking state and loading spinner */
    .channel-item.checking {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add a shadow effect */
      border: 2px solid #3498db; /* Change border color as desired */
      transition: box-shadow 0.3s ease-in-out, border 0.3s ease-in-out; /* Add transition effect */
    }
     /* CSS modifications for channel-item checking state and loading spinner */
    .channel-item.checking {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add a shadow effect */
      border: 2px solid #3498db; /* Change border color as desired */
      transition: box-shadow 0.3s ease-in-out, border 0.3s ease-in-out; /* Add transition effect */
    }

    .loading-spinner {
      width: 30px;
      height: 30px;
      border: 4px solid rgba(0, 0, 0, 0.1);
      border-radius: 50%;
      border-top: 4px solid #3498db; /* Change the color as desired */
      animation: spin 1s linear infinite; /* Apply a rotation animation */
      display: none; /* Initially hide the spinner */
    }

    /* Animation for the spinner */
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .channel-item.checking .loading-spinner {
      display: block;
    }


  </style>
  <title>Toffee Monitoring App</title>
</head>
<body>
  <header style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; align-items: center;">
        <a href="#">
          <img src="{{ asset('/admin/dist/img/toffee-icon.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 20px; border-left-width: 0px; height: 30px; width: 115px;margin-top: 10px;">
        </a>
        <h1 style="text-align: center; margin-left: 400px;">Toffee Channel Check</h1>
    </div>
    <a href="{{ url('/') }}" class="nav-link" style="display: inline-block; padding: 8px 16px; background-color: #e6337a; color: white; text-decoration: none; border-radius: 4px;">
        Dashboard
    </a>
</header>
  <div class="mosaic-container">
   @foreach($cprofile_list as $channel)
    <div class="channel-item" id="channel{{ $channel->id }}">
        <a href="#" class="playButton" data-channel-link="{{ $channel->Profile_link }}">
            <img src="{{ url('upload/images/'.$channel->image) }}" class="brand-image elevation-3" style="opacity: .8; border-left-style: solid; margin-left: 25px; border-left-width: 0px; height: 40x; width:60px; margin-top: 10px;">
          </a>      
        <div class="channel-name" style="text-align: center;">{{ $channel->cname->name }}</div>
        <div class="channel-status">
            <span class="channel-light light-green"></span> <!-- Remove unnecessary </i> tag -->
            <span class="status">Status: Active</span>
        </div>
        <!-- Additional small buttons -->
        <div style="display: flex; justify-content: space-around; margin-top: 10px;">
          <div id="myDiv" class="mybutton"></div>
        </div>
  <!-- End of additional small buttons -->
      <div class="loading-spinner"></div> <!-- Loading spinner HTML -->

    </div>
@endforeach
</div>

    <!-- Modal for video playback -->
    <div id="videoModal" class="modal">
        <div class="modal-content" style="width: 400px;height: 400px;">
          <span class="close">&times;</span>
          <div id="rmp" style="display: block;"></div>
        </div>
      </div>

<!-- Include Radiant Media Player JavaScript library -->
<script src="https://cdn.radiantmediatechs.com/rmp/9.12.0/js/rmp-hlsjs.min.js"></script>

<!-- Add a div container with a unique id - video and UI elements will be appended to this container -->
<script>

function checkChannelStatus(channelItem) {
  var playButton = channelItem.querySelector('.playButton');
  var channelLink = playButton.dataset.channelLink;
  var spinner = channelItem.querySelector('.loading-spinner'); // Get the spinner element

  spinner.style.display = 'block'; // Show the spinner for the current channel
  hideSpinnersExcept(channelItem); // Hide spinners for other channels

  return new Promise((resolve, reject) => {
    fetchChannelLink(channelLink, channelItem)
      .then(() => {
        spinner.style.display = 'none'; // Hide the spinner when checking is complete
        resolve();
      })
      .catch(error => {
        spinner.style.display = 'none'; // Hide the spinner if an error occurs during checking
        reject(error);
      });
  });
}

function hideSpinnersExcept(currentChannelItem) {
  var channelItems = document.querySelectorAll('.channel-item');
  channelItems.forEach(item => {
    var spinner = item.querySelector('.loading-spinner');
    if (item !== currentChannelItem) {
      spinner.style.display = 'none'; // Hide spinners for other channels
    }
  });
}

function checkChannelsSequentially() {
  var channelItems = document.querySelectorAll('.channel-item');
  var index = 0;

  function startChecking() {
    var checkInterval = setInterval(() => {
      if (index < channelItems.length) {
        checkChannelStatus(channelItems[index])
          .then(() => {
            index++;
          })
          .catch(error => {
            console.error('Error checking channel:', error);
            index++;
          });
      } else {
        clearInterval(checkInterval); // Stop when all channels are checked
        index = 0; // Reset index to start checking from the first channel
        // setTimeout(() => {
        //   location.reload(); // Reload the page after all channels have been checked
        // }, 9000); // Adjust the time before reload (in milliseconds)

        startChecking();

      }
    
    }, 1000); // Check every 5 seconds
  }

  // Start checking channels
  startChecking();
}
  function initializeVideoPlayback() {
    var channelItems = document.querySelectorAll('.channel-item');
    channelItems.forEach(function(channelItem) {
      var playButton = channelItem.querySelector('.playButton');
      var channelLink = playButton.dataset.channelLink;
      fetchChannelLink(channelLink,channelItem);
    });
  }
// Fetch and log the response from the channel link
function fetchChannelLink(channelLink,channelItem) {
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

      //show the manifest file
      // console.log(generatedURLs);

         // Fetch responses from generated URLs and log them
         fetchAndLogAllResponses(generatedURLs,channelItem);
      
      // You can process or handle the stream information further here as needed
    })
    .catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });
}


function generateFullURLs(responseText, baseURL) {
  const lines = responseText.split('\n');
  const fullURLsWithChannels = [];

  for (let i = 0; i < lines.length; i++) {
    if (lines[i].startsWith('#EXT-X-STREAM-INF:')) {
      const regexResult = /\/([^/]+\.m3u8)\?bitrate=(\d+)&channel=([^&]+)/.exec(lines[i + 1]);
      if (regexResult && regexResult.length === 4) {
        const fileName = regexResult[1];
        const bitrate = regexResult[2];
        const channel = regexResult[3];

        const fullURL = `${baseURL}${channel}/${fileName}?bitrate=${bitrate}&channel=${channel}&gp_id=`;
       
        // Push an object with full URL and channel value
        fullURLsWithChannels.push({
          fullURL: fullURL,
          channel: channel
        });
      }
    }
  }
  return fullURLsWithChannels;
}


// Function to fetch responses from all URLs and log them
function fetchAndValidateAllUrls(urls, channelItem) {
  const promises = urls.map(urlData =>
    fetch(urlData.fullURL)
      .then(response => {
        if (!response.ok) {
          throw new Error(`Network response was not ok for ${urlData.fullURL}`);
        }
        return response.text();
      })
      .then(data => validateResponse(data, urlData.channel,channelItem)) // Pass channel data to validateResponse
      .catch(error => {
        console.error(`There was a problem with the fetch operation for ${urlData.fullURL}:`, error);
        return 'Invalid'; // Return 'Invalid' status if there's an error
      })
  );

  Promise.all(promises)
    .then(results => {
      const status = results.includes('Invalid') ? 'Inactive' : 'Active';
      updateChannelStatus(channelItem, status);
    });
}

// Modify the validateResponse function to return the validation result
function validateResponse(data, channel,channelItem) {
 // console.log('Channel:', channel); // Log the channel data
  const channelParts = channel.split('_'); // Split the channel string by underscore
  const lastPart = channelParts[channelParts.length - 1]; // Get the last part of the channel

  const lastThreeDigits = lastPart.slice(-3); // Extract the last three digits

  //console.log('Last three digits:', lastThreeDigits); // Log the last three digits
 
 
  const lines = data.split('\n');
  const requiredParameters = ['#EXTM3U', '#EXT-X-VERSION:3', '#EXT-X-MEDIA-SEQUENCE', '#EXT-X-TARGETDURATION', '#EXT-X-KEY'];
  const presentParameters = requiredParameters.filter(param => lines.some(line => line.startsWith(param)));
  const tsFiles = lines.filter(line => line.endsWith('.ts'));
  const isKeyMethodPresent = lines.some(line => line.includes('EXT-X-KEY:METHOD=AES-128'));

  if (presentParameters.length === requiredParameters.length && tsFiles.length > 0 && isKeyMethodPresent && channel) {
    return 'Valid';

  } else {

     const myDiv = channelItem.querySelector('.mybutton');

    // Create a button element
    const myButton = document.createElement("button");
    myButton.textContent = lastThreeDigits;
    myButton.style.width = "30px";
    myButton.style.height = "30px";
    myButton.style.backgroundColor = "white";
    myButton.style.border = "none";
    myButton.style.borderRadius = "50%";

    // Append the button to myDiv
    myDiv.appendChild(myButton);
    
    return 'Invalid';
  }
}

// Update channel status based on the collective validation result
function updateChannelStatus(channelItem, status) {
  const light = channelItem.querySelector('.channel-light');
  const statusText = channelItem.querySelector('.status');
  const channelDiv = channelItem;

  if (status === 'Active') {
    light.classList.remove('light-red');
    light.classList.add('light-green');
    statusText.textContent = 'Status: Active';
    channelDiv.style.backgroundColor = 'lightgreen';
  } else {
    light.classList.remove('light-green');
    // light.innerHTML = '<i class="fa fa-circle text-danger-glow blink"></i>';
    light.classList.add('light-red');
    statusText.textContent = 'Status: Inactive';
    channelDiv.style.backgroundColor = 'lightcoral';
  }
}

// Modify the existing function where all responses are fetched and validated
function fetchAndLogAllResponses(urls, channelItem) {
  fetchAndValidateAllUrls(urls, channelItem);
}
// Open modal and play video when play button is clicked
  var playButtons = document.querySelectorAll('.playButton');
    playButtons.forEach(function(playButton) {
      playButton.addEventListener('click', function() {
        document.getElementById('videoModal').style.display = 'block';
        var channelLink = this.dataset.channelLink; // Fetching data-channel-link attribute from the clicked element
        playVideo(channelLink); // Function to start video playback
       
      });
    });

    // Close modal when close button is clicked
    document.querySelector('.close').addEventListener('click', function() {
      document.getElementById('videoModal').style.display = 'none';
      stopVideo(); // Function to stop video playback
    });

    // Function to start video playback
    function playVideo(channelLink) {
      const src = {
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

 // Trigger video playback initialization when the page loads
 window.addEventListener('load', function() {
    initializeVideoPlayback();
    // checkChannelsSequentially();
  });
</script>

</body>
</html>
