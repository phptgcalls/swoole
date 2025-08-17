<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email_pattern int length true apple_signin_allowed true google_signin_allowed int reset_available_period int reset_pending_date
 * @return auth.SentCodeType
 */

final class SentCodeTypeEmailCode extends Instance {
	public function request(string $email_pattern,int $length,? true $apple_signin_allowed = null,? true $google_signin_allowed = null,? int $reset_available_period = null,? int $reset_pending_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf450f59b);
		$flags = 0;
		$flags |= is_null($apple_signin_allowed) ? 0 : (1 << 0);
		$flags |= is_null($google_signin_allowed) ? 0 : (1 << 1);
		$flags |= is_null($reset_available_period) ? 0 : (1 << 3);
		$flags |= is_null($reset_pending_date) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($email_pattern);
		$writer->writeInt($length);
		if(is_null($reset_available_period) === false):
			$writer->writeInt($reset_available_period);
		endif;
		if(is_null($reset_pending_date) === false):
			$writer->writeInt($reset_pending_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['apple_signin_allowed'] = true;
		else:
			$result['apple_signin_allowed'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['google_signin_allowed'] = true;
		else:
			$result['google_signin_allowed'] = false;
		endif;
		$result['email_pattern'] = $reader->tgreadBytes();
		$result['length'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['reset_available_period'] = $reader->readInt();
		else:
			$result['reset_available_period'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['reset_pending_date'] = $reader->readInt();
		else:
			$result['reset_pending_date'] = null;
		endif;
		return new self($result);
	}
}

?>