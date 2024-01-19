if (videoLink) {
    var videoId = getYouTubeVideoId(videoLink);
    var embedUrl = 'https://www.youtube.com/embed/' + videoId;
    document.getElementById('youtubeVideoFrame').src = embedUrl;
} else {
    // Default YouTube video if videoLink is not provided
    document.getElementById('youtubeVideoFrame').src = 'https://www.youtube.com/embed/tgbNymZ7vqY';
}

function getYouTubeVideoId(link) {
    var regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
    var match = link.match(regex);
    return match && match[1] ? match[1] : null;
}
