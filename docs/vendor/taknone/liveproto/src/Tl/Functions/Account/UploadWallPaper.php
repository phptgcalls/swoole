<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfile file string mime_type wallpapersettings settings true for_chat
 * @return WallPaper
 */

final class UploadWallPaper extends Instance {
	public function request(object $file,string $mime_type,object $settings,? true $for_chat = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe39a8f03);
		$flags = 0;
		$flags |= is_null($for_chat) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($file->read());
		$writer->tgwriteBytes($mime_type);
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>