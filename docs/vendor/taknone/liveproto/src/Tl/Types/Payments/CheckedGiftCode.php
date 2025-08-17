<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date int months Vector<Chat> chats Vector<User> users true via_giveaway peer from_id int giveaway_msg_id long to_id int used_date
 * @return payments.CheckedGiftCode
 */

final class CheckedGiftCode extends Instance {
	public function request(int $date,int $months,array $chats,array $users,? true $via_giveaway = null,? object $from_id = null,? int $giveaway_msg_id = null,? int $to_id = null,? int $used_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x284a1096);
		$flags = 0;
		$flags |= is_null($via_giveaway) ? 0 : (1 << 2);
		$flags |= is_null($from_id) ? 0 : (1 << 4);
		$flags |= is_null($giveaway_msg_id) ? 0 : (1 << 3);
		$flags |= is_null($to_id) ? 0 : (1 << 0);
		$flags |= is_null($used_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($from_id) === false):
			$writer->write($from_id->read());
		endif;
		if(is_null($giveaway_msg_id) === false):
			$writer->writeInt($giveaway_msg_id);
		endif;
		if(is_null($to_id) === false):
			$writer->writeLong($to_id);
		endif;
		$writer->writeInt($date);
		$writer->writeInt($months);
		if(is_null($used_date) === false):
			$writer->writeInt($used_date);
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['via_giveaway'] = true;
		else:
			$result['via_giveaway'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['from_id'] = $reader->tgreadObject();
		else:
			$result['from_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['giveaway_msg_id'] = $reader->readInt();
		else:
			$result['giveaway_msg_id'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['to_id'] = $reader->readLong();
		else:
			$result['to_id'] = null;
		endif;
		$result['date'] = $reader->readInt();
		$result['months'] = $reader->readInt();
		if($flags & (1 << 1)):
			$result['used_date'] = $reader->readInt();
		else:
			$result['used_date'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>