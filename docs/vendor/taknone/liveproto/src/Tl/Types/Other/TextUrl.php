<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext text string url long webpage_id
 * @return RichText
 */

final class TextUrl extends Instance {
	public function request(object $text,string $url,int $webpage_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3c2884c1);
		$writer->write($text->read());
		$writer->tgwriteBytes($url);
		$writer->writeLong($webpage_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadObject();
		$result['url'] = $reader->tgreadBytes();
		$result['webpage_id'] = $reader->readLong();
		return new self($result);
	}
}

?>