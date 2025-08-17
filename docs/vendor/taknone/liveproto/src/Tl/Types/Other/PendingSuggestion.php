<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string suggestion textwithentities title textwithentities description string url
 * @return PendingSuggestion
 */

final class PendingSuggestion extends Instance {
	public function request(string $suggestion,object $title,object $description,string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe7e82e12);
		$writer->tgwriteBytes($suggestion);
		$writer->write($title->read());
		$writer->write($description->read());
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['suggestion'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadObject();
		$result['description'] = $reader->tgreadObject();
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>