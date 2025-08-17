<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<Update> updates Vector<User> users Vector<Chat> chats int date int seq_start int seq
 * @return Updates
 */

final class UpdatesCombined extends Instance {
	public function request(array $updates,array $users,array $chats,int $date,int $seq_start,int $seq) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x725b04c3);
		$writer->tgwriteVector($updates,'Update');
		$writer->tgwriteVector($users,'User');
		$writer->tgwriteVector($chats,'Chat');
		$writer->writeInt($date);
		$writer->writeInt($seq_start);
		$writer->writeInt($seq);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['updates'] = $reader->tgreadVector('Update');
		$result['users'] = $reader->tgreadVector('User');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['date'] = $reader->readInt();
		$result['seq_start'] = $reader->readInt();
		$result['seq'] = $reader->readInt();
		return new self($result);
	}
}

?>