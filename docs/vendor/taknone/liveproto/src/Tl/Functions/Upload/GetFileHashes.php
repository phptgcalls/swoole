<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfilelocation location long offset
 * @return Vector<FileHash>
 */

final class GetFileHashes extends Instance {
	public function request(object $location,int $offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9156982a);
		$writer->write($location->read());
		$writer->writeLong($offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>