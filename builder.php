<?php
// builder.php - dependency-free PHP static-site builder
// Usage: php builder.php

$SRC = __DIR__ . '/src';
$OUT = __DIR__ . '/public';

if (!is_dir($SRC)) {
    fwrite(STDERR, "Create a src/ folder with .md files first.\n");
    exit(1);
}
if (!is_dir($OUT)) {
    mkdir($OUT, 0755, true);
}

// Helpers
function esc($s) {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function inlineTransform($s) {
    // preserve code spans first
    $s = preg_replace_callback('/`([^`]+)`/u', function($m){ return '<code>' . esc($m[1]) . '</code>'; }, $s);

    // images ![alt](url)
    $s = preg_replace('/!\[([^\]]*)\]\(([^)]+)\)/u', '<img alt="$1" src="$2" />', $s);

    // links [text](url)
    $s = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/u', '<a href="$2">$1</a>', $s);

    // bold **text**
    $s = preg_replace('/\*\*([^*]+)\*\*/u', '<strong>$1</strong>', $s);

    // italic *text*
    $s = preg_replace('/\*([^*]+)\*/u', '<em>$1</em>', $s);

    return $s;
}

function mdToHtml($md) {
    $lines = preg_split("/\r\n|\n|\r/", $md);
    $out = '';
    $inCode = false;
    $codeBuf = [];
    $inList = false;
    for ($i = 0; $i < count($lines); $i++) {
        $line = $lines[$i];

        // fenced code blocks
        if (preg_match('/^```/', $line)) {
            if (!$inCode) { $inCode = true; $codeBuf = []; continue; }
            else {
                $codeHtml = '<pre><code>' . esc(implode("\n", $codeBuf)) . '</code></pre>' . "\n";
                $out .= $codeHtml;
                $inCode = false;
                continue;
            }
        }
        if ($inCode) { $codeBuf[] = $line; continue; }

        // headings
        if (preg_match('/^(#{1,6})\s+(.*)$/', $line, $m)) {
            $level = strlen($m[1]);
            $content = inlineTransform(esc($m[2]));
            $out .= "<h{$level}>{$content}</h{$level}>\n";
            continue;
        }

        // hr
        if (preg_match('/^---+\s*$/', $line)) {
            $out .= "<hr />\n"; continue;
        }

        // unordered list
        if (preg_match('/^\s*[-*]\s+(.*)$/', $line, $m)) {
            if (!$inList) { $inList = true; $out .= "<ul>\n"; }
            $out .= '<li>' . inlineTransform(esc($m[1])) . "</li>\n";
            // close list if next line isn't a list item
            $nextLine = isset($lines[$i+1]) ? $lines[$i+1] : '';
            if (!preg_match('/^\s*[-*]\s+/', $nextLine)) { $out .= "</ul>\n"; $inList = false; }
            continue;
        }

        // blank line -> paragraph break
        if (trim($line) === '') { $out .= "\n"; continue; }

        // paragraph
        $out .= '<p>' . inlineTransform(esc(trim($line))) . "</p>\n";
    }
    return $out;
}

// Build pages
$files = array_filter(scandir($SRC), function($f){ return preg_match('/\.md$/i', $f); });
$indexLinks = [];

foreach ($files as $file) {
    $base = preg_replace('/\.md$/i', '', $file);
    $md = file_get_contents($SRC . '/' . $file);
    $htmlBody = mdToHtml($md);

    // Title is first H1 or filename
    $title = $base;
    if (preg_match('/^#\s+(.*)/m', $md, $tm)) $title = trim($tm[1]);

    $page = "<!doctype html>\n<html lang=\"en\">\n<head>\n<meta charset=\"utf-8\">\n<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">\n<title>" . esc($title) . "</title>\n<link rel=\"stylesheet\" href=\"/assets/style.css\">\n</head>\n<body>\n<header style=\"max-width:900px;margin:24px auto;padding:0 16px;\"><a href=\"/\">Home</a></header>\n<main style=\"max-width:900px;margin:8px auto;padding:0 16px;\">\n" . $htmlBody . "\n</main>\n<footer style=\"max-width:900px;margin:40px auto;padding:0 16px;color:#666;font-size:13px;\">Generated: " . date(DATE_ATOM) . "</footer>\n</body>\n</html>";

    file_put_contents($OUT . '/' . $base . '.html', $page);
    $indexLinks[] = ['title' => $title, 'href' => './' . $base . '.html'];
}

// Generate index.html
$li = '';
foreach ($indexLinks as $l) {
    $li .= '<li><a href="' . esc($l['href']) . '">' . esc($l['title']) . "</a></li>\n";
}
$indexHtml = "<?php print 'fuckme'; ?><!doctype html>\n<html lang=\"en\">\n<head>\n<meta charset=\"utf-8\">\n<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\">\n<title>Docs</title>\n<link rel=\"stylesheet\" href=\"/assets/style.css\">\n</head>\n<body>\n<main style=\"max-width:900px;margin:32px auto;padding:0 16px;\">\n<h1>Docs</h1>\n<ul>\n{$li}</ul>\n</main>\n</body>\n</html>";

file_put_contents($OUT . '/index.php', $indexHtml);

// Create a lightweight CSS asset
$assetsDir = $OUT . '/assets';
if (!is_dir($assetsDir)) mkdir($assetsDir, 0755, true);
$css = <<<CSS
body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial; color: #0c1720; background: #fff; }
a { color: #0b6df6; text-decoration: none; }
pre { background: #f6f8ff; padding: 12px; border-radius: 6px; overflow: auto; }
code { background: #f3f5ff; padding: 2px 4px; border-radius: 4px; }
img { max-width: 100%; height: auto; }
CSS;
file_put_contents($assetsDir . '/style.css', $css);

echo "Built " . count($indexLinks) . " pages -> public/\n";
