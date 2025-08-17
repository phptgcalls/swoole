<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int top_message int read_inbox_max_id int read_outbox_max_id int unread_count int unread_reactions_count true unread_mark true nopaid_messages_exception draftmessage draft
 * @return SavedDialog
 */

final class MonoForumDialog extends Instance {
	public function request(object $peer,int $top_message,int $read_inbox_max_id,int $read_outbox_max_id,int $unread_count,int $unread_reactions_count,? true $unread_mark = null,? true $nopaid_messages_exception = null,? object $draft = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x64407ea7);
		$flags = 0;
		$flags |= is_null($unread_mark) ? 0 : (1 << 3);
		$flags |= is_null($nopaid_messages_exception) ? 0 : (1 << 4);
		$flags |= is_null($draft) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($top_message);
		$writer->writeInt($read_inbox_max_id);
		$writer->writeInt($read_outbox_max_id);
		$writer->writeInt($unread_count);
		$writer->writeInt($unread_reactions_count);
		if(is_null($draft) === false):
			$writer->write($draft->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['unread_mark'] = true;
		else:
			$result['unread_mark'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['nopaid_messages_exception'] = true;
		else:
			$result['nopaid_messages_exception'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['top_message'] = $reader->readInt();
		$result['read_inbox_max_id'] = $reader->readInt();
		$result['read_outbox_max_id'] = $reader->readInt();
		$result['unread_count'] = $reader->readInt();
		$result['unread_reactions_count'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['draft'] = $reader->tgreadObject();
		else:
			$result['draft'] = null;
		endif;
		return new self($result);
	}
}

?>