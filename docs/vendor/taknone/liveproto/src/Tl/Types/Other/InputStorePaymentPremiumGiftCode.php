<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputUser> users string currency long amount inputpeer boost_peer textwithentities message
 * @return InputStorePaymentPurpose
 */

final class InputStorePaymentPremiumGiftCode extends Instance {
	public function request(array $users,string $currency,int $amount,? object $boost_peer = null,? object $message = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfb790393);
		$flags = 0;
		$flags |= is_null($boost_peer) ? 0 : (1 << 0);
		$flags |= is_null($message) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteVector($users,'InputUser');
		if(is_null($boost_peer) === false):
			$writer->write($boost_peer->read());
		endif;
		$writer->tgwriteBytes($currency);
		$writer->writeLong($amount);
		if(is_null($message) === false):
			$writer->write($message->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['users'] = $reader->tgreadVector('InputUser');
		if($flags & (1 << 0)):
			$result['boost_peer'] = $reader->tgreadObject();
		else:
			$result['boost_peer'] = null;
		endif;
		$result['currency'] = $reader->tgreadBytes();
		$result['amount'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['message'] = $reader->tgreadObject();
		else:
			$result['message'] = null;
		endif;
		return new self($result);
	}
}

?>