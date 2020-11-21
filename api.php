<?php

/* ------------------------------------------
Placeholder api

Use the apiBindings.json settings 
to call the content you need!
------------------------------------------ */

if ($_GET["uid"] == "home") {
  $responseData = [
    "title" => "Homepage",
    "text"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
  ];
} elseif ($_GET["uid"] == "projects") {
  $responseData = [
    "items" => [
      ["title" => "Project 1", "desc" => "In vel vestibulum nisi. Donec sagittis nunc id erat aliquam blandit."],
      ["title" => "Project 2", "desc" => "Ut in sapien magna. Mauris lacus ex, pretium nec odio sit amet."],
      ["title" => "Project 3", "desc" => "Fusce vel nisi scelerisque, gravida purus at, hendrerit purus."],
    ]
  ];
} elseif ($_GET["uid"] == "about") {
  $responseData = [
    "title" => "About",
    "text"  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed turpis sed ipsum vehicula bibendum imperdiet in orci. In vel vestibulum nisi. Donec sagittis nunc id erat aliquam blandit. Ut in sapien magna. Mauris lacus ex, pretium nec odio sit amet, gravida faucibus nisi. Fusce vel nisi scelerisque, gravida purus at, hendrerit purus. Nulla efficitur lorem sit amet scelerisque sagittis.",
  ];
}

header('Content-Type: application/json');
echo json_encode($responseData);
