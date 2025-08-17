<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long file_id int file_part bytes bytes
 * @return Bool
 */

final class SaveFilePart extends Instance {
	public function request(int $file_id,int $file_part,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb304a621);
		$writer->writeLong($file_id);
		$writer->writeInt($file_part);
		$writer->tgwriteBytes($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>