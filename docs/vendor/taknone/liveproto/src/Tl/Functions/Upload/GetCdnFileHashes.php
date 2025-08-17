<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes file_token long offset
 * @return Vector<FileHash>
 */

final class GetCdnFileHashes extends Instance {
	public function request(string $file_token,int $offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x91dc3f31);
		$writer->tgwriteBytes($file_token);
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