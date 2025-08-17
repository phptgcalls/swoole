<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int folder_id Vector<DialogPeer> order
 * @return Update
 */

final class UpdatePinnedDialogs extends Instance {
	public function request(? int $folder_id = null,? array $order = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfa0f3ca2);
		$flags = 0;
		$flags |= is_null($folder_id) ? 0 : (1 << 1);
		$flags |= is_null($order) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		if(is_null($order) === false):
			$writer->tgwriteVector($order,'DialogPeer');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['order'] = $reader->tgreadVector('DialogPeer');
		else:
			$result['order'] = null;
		endif;
		return new self($result);
	}
}

?>