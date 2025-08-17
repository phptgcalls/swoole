<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes file_token long offset int limit
 * @return upload.CdnFile
 */

final class GetCdnFile extends Instance {
	public function request(string $file_token,int $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x395f69da);
		$writer->tgwriteBytes($file_token);
		$writer->writeLong($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>