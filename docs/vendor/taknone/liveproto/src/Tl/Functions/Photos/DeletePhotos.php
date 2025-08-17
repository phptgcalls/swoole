<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputPhoto> id
 * @return Vector<long>
 */

final class DeletePhotos extends Instance {
	public function request(array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x87cf7f2f);
		$writer->tgwriteVector($id,'InputPhoto');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>