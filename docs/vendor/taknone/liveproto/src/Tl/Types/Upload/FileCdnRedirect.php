<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Upload;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int dc_id bytes file_token bytes encryption_key bytes encryption_iv Vector<FileHash> file_hashes
 * @return upload.File
 */

final class FileCdnRedirect extends Instance {
	public function request(int $dc_id,string $file_token,string $encryption_key,string $encryption_iv,array $file_hashes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf18cda44);
		$writer->writeInt($dc_id);
		$writer->tgwriteBytes($file_token);
		$writer->tgwriteBytes($encryption_key);
		$writer->tgwriteBytes($encryption_iv);
		$writer->tgwriteVector($file_hashes,'FileHash');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['dc_id'] = $reader->readInt();
		$result['file_token'] = $reader->tgreadBytes();
		$result['encryption_key'] = $reader->tgreadBytes();
		$result['encryption_iv'] = $reader->tgreadBytes();
		$result['file_hashes'] = $reader->tgreadVector('FileHash');
		return new self($result);
	}
}

?>