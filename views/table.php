<?php
/**
 * Index page template
 * Map of scienceforukraine.eu
 *
 * @var Page $page
 */

$page->title = "Science for Ukraine - Institutions";

?>
<script src="assets/tabulator/js/tabulator.js"></script>
<script src="assets/table.js"></script>

<h1>Institutions</h1>

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
      <button class="btn btn-info" data-field="all-disciplines">
        All disciplines
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
  </ul>
</nav>

<div id="institution-table">
</div>