<?php 
/**
 * Index page template
 * Map of scienceforukraine.eu
 * 
 * @var Page $page
 */

$page->title = "Science for Ukraine";

?>
<nav class="text-center">
  <ul>
    <li>
      <button class="btn btn-secondary">
        Researchers
      </button>
    </li>
    <li>
      <button class="btn btn-secondary">
        Students
      </button>
    </li>
    <li>
      <button class="btn btn-secondary">
        Accommodation
      </button>
    </li>
    <li>
      <button class="btn btn-secondary">
        Funding
      </button>
    </li>
  </ul>
</nav>

<div id="example-map" class="osm-map" style="height: 600px;"></div>