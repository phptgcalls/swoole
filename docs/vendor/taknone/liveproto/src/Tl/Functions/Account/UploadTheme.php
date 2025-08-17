<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfile file string file_name string mime_type inputfile thumb
 * @return Document
 */

final class UploadTheme extends Instance {
	public function request(object $file,string $file_name,string $mime_type,? object $thumb = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1c3db333);
		$flags = 0;
		$flags |= is_null($thumb) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($file->read());
		if(is_null($thumb) === false):
			$writer->write($thumb->read());
		endif;
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