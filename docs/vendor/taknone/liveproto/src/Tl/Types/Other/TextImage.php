<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long document_id int w int h
 * @return RichText
 */

final class TextImage extends Instance {
	public function request(int $document_id,int $w,int $h) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x81ccf4f);
		$writer->writeLong($document_id);
		$writer->writeInt($w);
		$writer->writeInt($h);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['document_id'] = $reader->readLong();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		return new self($result);
	}
}

?>