<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfile file string file_name string mime_type
 * @return Document
 */

final class UploadRingtone extends Instance {
	public function request(object $file,string $file_name,string $mime_type) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x831a83a2);
		$writer->write($file->read());
		$writer->tgwriteBytes($file_name);
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