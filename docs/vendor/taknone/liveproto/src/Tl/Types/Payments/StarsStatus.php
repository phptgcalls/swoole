<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param starsamount balance Vector<Chat> chats Vector<User> users Vector<StarsSubscription> subscriptions string subscriptions_next_offset long subscriptions_missing_balance Vector<StarsTransaction> history string next_offset
 * @return payments.StarsStatus
 */

final class StarsStatus extends Instance {
	public function request(object $balance,array $chats,array $users,? array $subscriptions = null,? string $subscriptions_next_offset = null,? int $subscriptions_missing_balance = null,? array $history = null,? string $next_offset = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c9ce8ed);
		$flags = 0;
		$flags |= is_null($subscriptions) ? 0 : (1 << 1);
		$flags |= is_null($subscriptions_next_offset) ? 0 : (1 << 2);
		$flags |= is_null($subscriptions_missing_balance) ? 0 : (1 << 4);
		$flags |= is_null($history) ? 0 : (1 << 3);
		$flags |= is_null($next_offset) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($balance->read());
		if(is_null($subscriptions) === false):
			$writer->tgwriteVector($subscriptions,'StarsSubscription');
		endif;
		if(is_null($subscriptions_next_offset) === false):
			$writer->tgwriteBytes($subscriptions_next_offset);
		endif;
		if(is_null($subscriptions_missing_balance) === false):
			$writer->writeLong($subscriptions_missing_balance);
		endif;
		if(is_null($history) === false):
			$writer->tgwriteVector($history,'StarsTransaction');
		endif;
		if(is_null($next_offset) === false):
			$writer->tgwriteBytes($next_offset);
		endif;
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['balance'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['subscriptions'] = $reader->tgreadVector('StarsSubscription');
		else:
			$result['subscriptions'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['subscriptions_next_offset'] = $reader->tgreadBytes();
		else:
			$result['subscriptions_next_offset'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['subscriptions_missing_balance'] = $reader->readLong();
		else:
			$result['subscriptions_missing_balance'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['history'] = $reader->tgreadVector('StarsTransaction');
		else:
			$result['history'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['next_offset'] = $reader->tgreadBytes();
		else:
			$result['next_offset'] = null;
		endif;
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>