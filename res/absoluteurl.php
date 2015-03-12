<?php 
function make_absolute_path ($baseUrl, $relativePath) {

    // Parse URLs, return FALSE on failure
    if ((!$baseParts = parse_url($baseUrl)) || (!$pathParts = parse_url($relativePath))) {
        return FALSE;
    }

    // Work-around for pre- 5.4.7 bug in parse_url() for relative protocols
    if (empty($baseParts['host']) && !empty($baseParts['path']) && substr($baseParts['path'], 0, 2) === '//') {
        $parts = explode('/', ltrim($baseParts['path'], '/'));
        $baseParts['host'] = array_shift($parts);
        $baseParts['path'] = '/'.implode('/', $parts);
    }
    if (empty($pathParts['host']) && !empty($pathParts['path']) && substr($pathParts['path'], 0, 2) === '//') {
        $parts = explode('/', ltrim($pathParts['path'], '/'));
        $pathParts['host'] = array_shift($parts);
        $pathParts['path'] = '/'.implode('/', $parts);
    }

    // Relative path has a host component, just return it
    if (!empty($pathParts['host'])) {
        return $relativePath;
    }

    // Normalise base URL (fill in missing info)
    // If base URL doesn't have a host component return error
    if (empty($baseParts['host'])) {
        return FALSE;
    }
    if (empty($baseParts['path'])) {
        $baseParts['path'] = '/';
    }
    if (empty($baseParts['scheme'])) {
        $baseParts['scheme'] = 'http';
    }

    // Start constructing return value
    $result = $baseParts['scheme'].'://';

    // Add username/password if any
    if (!empty($baseParts['user'])) {
        $result .= $baseParts['user'];
        if (!empty($baseParts['pass'])) {
            $result .= ":{$baseParts['pass']}";
        }
        $result .= '@';
    }

    // Add host/port
    $result .= !empty($baseParts['port']) ? "{$baseParts['host']}:{$baseParts['port']}" : $baseParts['host'];

    // Inspect relative path path
    if ($relativePath[0] === '/') {

        // Leading / means from root
        $result .= $relativePath;

    } else if ($relativePath[0] === '?') {

        // Leading ? means query the existing URL
        $result .= $baseParts['path'].$relativePath;

    } else {

        // Get the current working directory
        $resultPath = rtrim(substr($baseParts['path'], -1) === '/' ? trim($baseParts['path']) : str_replace('\\', '/', dirname(trim($baseParts['path']))), '/');

        // Split the image path into components and loop them
        foreach (explode('/', $relativePath) as $pathComponent) {
            switch ($pathComponent) {
                case '': case '.':
                    // a single dot means "this directory" and can be skipped
                    // an empty space is a mistake on somebodies part, and can also be skipped
                    break;
                case '..':
                     // a double dot means "up a directory"
                    $resultPath = rtrim(str_replace('\\', '/', dirname($resultPath)), '/');
                    break;
                default:
                    // anything else can be added to the path
                    $resultPath .= "/$pathComponent";
                    break;
            }
        }

        // Add path to result
        $result .= $resultPath;

    }

    return $result;

} ?>