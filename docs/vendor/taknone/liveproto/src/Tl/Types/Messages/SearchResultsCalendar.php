<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count int min_date int min_msg_id Vector<SearchResultsCalendarPeriod> periods Vector<Message> messages Vector<Chat> chats Vector<User> users true inexact int offset_id_offset
 * @return messages.SearchResultsCalendar
 */

final class SearchResultsCalendar extends Instance {
	public function request(int $count,int $min_date,int $min_msg_id,array $periods,array $messages,array $chats,array $users,? true $inexact = null,? int $offset_id_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x147ee23c);
		$flags = 0;
		$flags |= is_null($inexact) ? 0 : (1 << 0);
		$flags |= is_null($offset_id_offset) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($count);
		$writer->writeInt($min_date);
		$writer->writeInt($min_msg_id);
		if(is_null($offset_id_offset) === false):
			$writer->writeInt($offset_id_offset);
		endif;
		$writer->tgwriteVector($periods,'SearchResultsCalendarPeriod');
		$writer->tgwriteVector($messages,'Message');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['inexact'] = true;
		else:
			$result['inexact'] = false;
		endif;
		$result['count'] = $reader->readInt();
		$result['min_date'] = $reader->readInt();
		$result['min_msg_id'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['offset_id_offset'] = $reader->readInt();
		else:
			$result['offset_id_offset'] = null;
		endif;
		$result['periods'] = $reader->tgreadVector('SearchResultsCalendarPeriod');
		$result['messages'] = $reader->tgreadVector('Message');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>