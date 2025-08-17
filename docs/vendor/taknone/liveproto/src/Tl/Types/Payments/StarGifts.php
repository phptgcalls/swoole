<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int hash Vector<StarGift> gifts Vector<Chat> chats Vector<User> users
 * @return payments.StarGifts
 */

final class StarGifts extends Instance {
	public function request(int $hash,array $gifts,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2ed82995);
		$writer->writeInt($hash);
		$writer->tgwriteVector($gifts,'StarGift');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readInt();
		$result['gifts'] = $reader->tgreadVector('StarGift');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>