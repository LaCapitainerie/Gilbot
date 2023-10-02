<?php include('head.php'); ?>

<body class="center-body">
    <div class="media-controls">
    <div class="media-buttons">
        <button class="back-button media-button" label="back">
        <i class="fas fa-step-backward button-icons"></i>
        <span class="button-text milli">Back</span>
        </button>


        <button class="play-button media-button" label="play">
        <i class="fas fa-play button-icons delta"></i>
        <span class="button-text milli">Play</span>
        </button>

        <button class="fast-forward-button media-button" label="fast forward">


        <button class="skip-button media-button" label="skip">
        <i class="fas fa-step-forward button-icons"></i>
        <span class="button-text milli">Skip</span>
        </button>
    </div>
    <div class="media-progress">
        <div class="progress-bar-wrapper progress">
        <div id="loader-progress-bar">
        </div>
        </div>
        <div class="progress-time-current milli"></div>
        
        <div class="progress-time-total milli"></div>
    </div>
    </div>
</body>
<audio src=''></audio>
<script>getmusic(<?php echo htmlspecialchars($_GET['id']);?>);</script>
