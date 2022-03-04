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
      <button class="btn btn-secondary" data-field="researchers">
        Researchers
      </button>
    </li>
    <li>
      <button class="btn btn-secondary" data-field="students">
        Students
      </button>
    </li>
    <li>
      <button class="btn btn-secondary" data-field="accommodation">
        Accommodation
      </button>
    </li>
    <li>
      <button class="btn btn-secondary" data-field="funding">
        Funding
      </button>
    </li>
    <li>
      <button class="btn btn-info" data-field="humanities-social-science">
        Humanities
      </button>
    </li>
    <li>
      <button class="btn btn-info" data-field="natural-science">
        Natural
      </button>
    </li>
    <li>
      <button class="btn btn-info" data-field="engineering">
        Engineering
      </button>
    </li>
    <li>
      <button class="btn btn-info" data-field="unspecified">
        Unspecified
      </button>
    </li>
  </ul>
</nav>

<div id="example-map" class="osm-map" style="height: 600px;"></div>