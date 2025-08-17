<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url int size string mime_type Vector<DocumentAttribute> attributes
 * @return InputWebDocument
 */

final class InputWebDocument extends Instance {
	public function request(string $url,int $size,string $mime_type,array $attributes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9bed434d);
		$writer->tgwriteBytes($url);
		$writer->writeInt($size);
		$writer->tgwriteBytes($mime_type);
		$writer->tgwriteVector($attributes,'DocumentAttribute');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['size'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['attributes'] = $reader->tgreadVector('DocumentAttribute');
		return new self($result);
	}
}

?>