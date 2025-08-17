<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash bytes file_reference string thumb_size
 * @return InputFileLocation
 */

final class InputDocumentFileLocation extends Instance {
	public function request(int $id,int $access_hash,string $file_reference,string $thumb_size) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbad07584);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($file_reference);
		$writer->tgwriteBytes($thumb_size);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['file_reference'] = $reader->tgreadBytes();
		$result['thumb_size'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>