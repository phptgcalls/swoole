<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int msg_id Vector<MessageExtendedMedia> extended_media
 * @return Update
 */

final class UpdateMessageExtendedMedia extends Instance {
	public function request(object $peer,int $msg_id,array $extended_media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd5a41724);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->tgwriteVector($extended_media,'MessageExtendedMedia');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		$result['extended_media'] = $reader->tgreadVector('MessageExtendedMedia');
		return new self($result);
	}
}

?>