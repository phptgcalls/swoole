<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param passwordkdfalgo new_algo securepasswordkdfalgo new_secure_algo bytes secure_random true has_recovery true has_secure_values true has_password passwordkdfalgo current_algo bytes srp_B long srp_id string hint string email_unconfirmed_pattern int pending_reset_date string login_email_pattern
 * @return account.Password
 */

final class Password extends Instance {
	public function request(object $new_algo,object $new_secure_algo,string $secure_random,? true $has_recovery = null,? true $has_secure_values = null,? true $has_password = null,? object $current_algo = null,? string $srp_B = null,? int $srp_id = null,? string $hint = null,? string $email_unconfirmed_pattern = null,? int $pending_reset_date = null,? string $login_email_pattern = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x957b50fb);
		$flags = 0;
		$flags |= is_null($has_recovery) ? 0 : (1 << 0);
		$flags |= is_null($has_secure_values) ? 0 : (1 << 1);
		$flags |= is_null($has_password) ? 0 : (1 << 2);
		$flags |= is_null($current_algo) ? 0 : (1 << 2);
		$flags |= is_null($srp_B) ? 0 : (1 << 2);
		$flags |= is_null($srp_id) ? 0 : (1 << 2);
		$flags |= is_null($hint) ? 0 : (1 << 3);
		$flags |= is_null($email_unconfirmed_pattern) ? 0 : (1 << 4);
		$flags |= is_null($pending_reset_date) ? 0 : (1 << 5);
		$flags |= is_null($login_email_pattern) ? 0 : (1 << 6);
		$writer->writeInt($flags);
		if(is_null($current_algo) === false):
			$writer->write($current_algo->read());
		endif;
		if(is_null($srp_B) === false):
			$writer->tgwriteBytes($srp_B);
		endif;
		if(is_null($srp_id) === false):
			$writer->writeLong($srp_id);
		endif;
		if(is_null($hint) === false):
			$writer->tgwriteBytes($hint);
		endif;
		if(is_null($email_unconfirmed_pattern) === false):
			$writer->tgwriteBytes($email_unconfirmed_pattern);
		endif;
		$writer->write($new_algo->read());
		$writer->write($new_secure_algo->read());
		$writer->tgwriteBytes($secure_random);
		if(is_null($pending_reset_date) === false):
			$writer->writeInt($pending_reset_date);
		endif;
		if(is_null($login_email_pattern) === false):
			$writer->tgwriteBytes($login_email_pattern);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['has_recovery'] = true;
		else:
			$result['has_recovery'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['has_secure_values'] = true;
		else:
			$result['has_secure_values'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['has_password'] = true;
		else:
			$result['has_password'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['current_algo'] = $reader->tgreadObject();
		else:
			$result['current_algo'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['srp_B'] = $reader->tgreadBytes();
		else:
			$result['srp_B'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['srp_id'] = $reader->readLong();
		else:
			$result['srp_id'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['hint'] = $reader->tgreadBytes();
		else:
			$result['hint'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['email_unconfirmed_pattern'] = $reader->tgreadBytes();
		else:
			$result['email_unconfirmed_pattern'] = null;
		endif;
		$result['new_algo'] = $reader->tgreadObject();
		$result['new_secure_algo'] = $reader->tgreadObject();
		$result['secure_random'] = $reader->tgreadBytes();
		if($flags & (1 << 5)):
			$result['pending_reset_date'] = $reader->readInt();
		else:
			$result['pending_reset_date'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['login_email_pattern'] = $reader->tgreadBytes();
		else:
			$result['login_email_pattern'] = null;
		endif;
		return new self($result);
	}
}

?>