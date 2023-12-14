@extends('admin.layouts.app')
@section('page_title')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1>Channel Dashboard</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
      <li class="breadcrumb-item active"></li>
    </ol>
  </div>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Logo</th>
          <th>Channel Name</th>
          <th>Service Name</th>
          <th>Channel status</th>
        </tr>
      </thead>
      <tbody>
        @php
        $counter = 1; // Initialize the counter variable
        @endphp
        @foreach ($cprofile_list as $item)
        <tr>
          <td>{{ $counter++ }}</td>
          <td><img src="{{ url('upload/images/'.$item->image) }}" alt="Image" class="img-fluid" width="35" height="25" data-channel-link="{{ $item->Profile_link }}"></td>
          <td>{{ $item->cname->name }}</td>
          <td>{{ \App\Enums\Service::getDescription($item->service_name) }}</td>
          <td class="status"><!-- Status will be updated dynamically --></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>

function initializeVideoPlayback() {
    var channelItems = document.querySelectorAll('.img-fluid');
    channelItems.forEach(function(channelItem) {
      var channelLink = channelItem.dataset.channelLink;
      fetchChannelLink(channelLink, channelItem.closest('tr'));
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

// Function to fetch responses from all URLs and log them
function fetchAndLogAllResponses(urls,channelItem) {
  for (let i = 0; i < urls.length; i++) {
    fetchAndLogResponse(urls[i],channelItem);
  }
}

function fetchAndLogResponse(url,channelItem) {
  fetch(url)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      console.log(`Response from ${url}:`);
      console.log(data);
      validateResponse(data,channelItem);
      // You can further process or handle the response data here as needed
    })
    .catch(error => {
      console.error(`There was a problem with the fetch operation for ${url}:`, error);
    });
}

function validateResponse(data, channelItem) {
    const lines = data.split('\n');
    const statusText = channelItem.querySelector('.status');
     // Validate required parameters
     const requiredParameters = ['#EXTM3U', '#EXT-X-VERSION:3', '#EXT-X-MEDIA-SEQUENCE', '#EXT-X-TARGETDURATION', '#EXT-X-KEY'];
     const presentParameters = requiredParameters.filter(param => lines.some(line => line.startsWith(param)));
     const tsFiles = lines.filter(line => line.endsWith('.ts'));
     const isKeyMethodPresent = lines.some(line => line.includes('EXT-X-KEY:METHOD=AES-128'));


    if (presentParameters.length === requiredParameters.length && tsFiles.length > 0 && isKeyMethodPresent) {
      // console.log('Validation successful: All required parameters present and .ts files found.');
      // Validation successful
      statusText.innerHTML = '<span style="color: green;"><i class="fas fa-check-circle"></i> Status: Active</span>';
    } else {
      // console.log('Validation failed: Missing required parameters or no .ts files found.');
      // Validation failed
      statusText.innerHTML = '<span style="color: red;"><i class="fas fa-times-circle"></i> Status: Inactive</span>';
    }
  }


 // Trigger video playback initialization when the page loads
 window.addEventListener('load', function() {
    initializeVideoPlayback();
  });
</script>
 
@endsection