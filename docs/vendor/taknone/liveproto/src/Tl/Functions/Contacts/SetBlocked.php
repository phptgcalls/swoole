<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputPeer> id int limit true my_stories_from
 * @return Bool
 */

final class SetBlocked extends Instance {
	public function request(array $id,int $limit,? true $my_stories_from = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x94c65c76);
		$flags = 0;
		$flags |= is_null($my_stories_from) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($id,'InputPeer');
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