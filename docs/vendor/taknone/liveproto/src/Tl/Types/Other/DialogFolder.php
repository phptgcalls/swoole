<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param folder folder peer peer int top_message int unread_muted_peers_count int unread_unmuted_peers_count int unread_muted_messages_count int unread_unmuted_messages_count true pinned
 * @return Dialog
 */

final class DialogFolder extends Instance {
	public function request(object $folder,object $peer,int $top_message,int $unread_muted_peers_count,int $unread_unmuted_peers_count,int $unread_muted_messages_count,int $unread_unmuted_messages_count,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x71bd134c);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($folder->read());
		$writer->write($peer->read());
		$writer->writeInt($top_message);
		$writer->writeInt($unread_muted_peers_count);
		$writer->writeInt($unread_unmuted_peers_count);
		$writer->writeInt($unread_muted_messages_count);
		$writer->writeInt($unread_unmuted_messages_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		$result['folder'] = $reader->tgreadObject();
		$result['peer'] = $reader->tgreadObject();
		$result['top_message'] = $reader->readInt();
		$result['unread_muted_peers_count'] = $reader->readInt();
		$result['unread_unmuted_peers_count'] = $reader->readInt();
		$result['unread_muted_messages_count'] = $reader->readInt();
		$result['unread_unmuted_messages_count'] = $reader->readInt();
		return new self($result);
	}
}

?>