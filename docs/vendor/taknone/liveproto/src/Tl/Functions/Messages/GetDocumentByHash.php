<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes sha256 long size string mime_type
 * @return Document
 */

final class GetDocumentByHash extends Instance {
	public function request(string $sha256,int $size,string $mime_type) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb1f2061f);
		$writer->tgwriteBytes($sha256);
		$writer->writeLong($size);
		$writer->tgwriteBytes($mime_type);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>