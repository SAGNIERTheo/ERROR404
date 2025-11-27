<?php
session_destroy();

header('Location: http://localhost:8000/?=homepage');
exit;