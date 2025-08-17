<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<DialogPeer> order
 * @return Update
 */

final class UpdatePinnedSavedDialogs extends Instance {
	public function request(? array $order = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x686c85a6);
		$flags = 0;
		$flags |= is_null($order) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($order) === false):
			$writer->tgwriteVector($order,'DialogPeer');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['order'] = $reader->tgreadVector('DialogPeer');
		else:
			$result['order'] = null;
		endif;
		return new self($result);
	}
}

?>