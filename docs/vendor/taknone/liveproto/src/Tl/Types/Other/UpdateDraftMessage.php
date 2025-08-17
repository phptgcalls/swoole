<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer draftmessage draft int top_msg_id peer saved_peer_id
 * @return Update
 */

final class UpdateDraftMessage extends Instance {
	public function request(object $peer,object $draft,? int $top_msg_id = null,? object $saved_peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedfc111e);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$flags |= is_null($saved_peer_id) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		if(is_null($saved_peer_id) === false):
			$writer->write($saved_peer_id->read());
		endif;
		$writer->write($draft->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['peer'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['top_msg_id'] = $reader->readInt();
		else:
			$result['top_msg_id'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['saved_peer_id'] = $reader->tgreadObject();
		else:
			$result['saved_peer_id'] = null;
		endif;
		$result['draft'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>