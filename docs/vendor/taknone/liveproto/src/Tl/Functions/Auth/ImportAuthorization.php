<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id bytes bytes
 * @return auth.Authorization
 */

final class ImportAuthorization extends Instance {
	public function request(int $id,string $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa57a7dad);
		$writer->writeLong($id);
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